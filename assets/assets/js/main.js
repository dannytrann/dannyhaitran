'use strict'

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// Model Section
//
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// Model of a tweet that has the following attributes
// user_name = The name that the user displays from their twitter
// profile_image = The image used by the user as their profile
// tweet_text = The body of text used by the tweet
// create_date = The date that the tweet was created
var Tweet = Backbone.Model.extend({
    default: {
        user_name: '',
        profile_image: '',
        tweet_text: '',
        create_date: ''
    }
});
//A model for each search that the user does which only takes a term,
// the order of the addition of searches doesn't matter because it won't be sorted
var Search = Backbone.Model.extend({
	default: {
		term: ''
	}
});

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// Collection Section
//
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//Collection for Tweets which is modelled by a Tweet
var Tweets = Backbone.Collection.extend({
    model: Tweet
});

//A collection to hold all the searches that are done by the user
var Searches = Backbone.Collection.extend({
	model: Search
});
//A global variable used by the whole application to find out the current searches
var searches = new Searches();

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// View Section
//
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

//A TweetCard is an individual Tweet which has the following information
//username
//profile image
//tweet text
//create date
//
//It also has a render method which will utilize the underscore template
var TweetCard = Backbone.View.extend({
    initialize: function() {
        this.model = new Tweet;
        this.collection = new Tweets;
    },
    render: function(){
        //Allows the template in the view to be communicated with the variable 'rc'
        _.templateSettings.variable = "rc";

        // Grab the HTML out of our template tag and pre-compile it.
        var template = _.template(
            $( "script.template" ).html()
        );
        //Iterates through the Tweets collection and applies each model to the template which then will be
        //added the view
        this.collection.each(function(model){
            var templateData = ({
                user_name: '<a href="http://twitter.com/' + model.get('user_name') + '">'+model.get('user_name') +'</a>',
                profile_image: model.get('profile_image'),
                tweet_text: model.get('tweet_text'),
                create_date: model.get('create_date')
            });

            // Render the underscore template and inject it after the H1
            // in our current DOM.
            $( "#tweets" ).prepend(
                template( templateData )
            );
        })
        //Clean out the collection for other tweets
        this.collection.reset();
    }
});

//a SearchView is binded to the div where all the previous searches will appear
//There is a global variable that keeps track of the collection so that can be accessed thoughout
var SearchView = Backbone.View.extend({
    tagName : "li",
    //A commonly used function that will fetch data with a ajax call to the php server
    fetchData : function(){

        //Retrieves the last search model in the searches collection
        var lastModel = searches.last();

        //Retrieves the term of the selected model
        var lastModelTerm = lastModel.get("term");

        //Empties the tweets so the collection can add more without making the list super long
        $("#tweets").empty();

        //Does an ajax call to the PHP proxy where it will return a JSON array of tweets
        $.ajax("/api/search", {
            data: {terms: lastModelTerm},
            success: function (data) {

                //Grabs the current tweet that is on top
                var currentTweets = new Tweets();

                var dataJSON = JSON.parse(data);
                for (var i = 0; i < dataJSON.length; i++) {
                    // A new Tweet is created and is given new data
                    var newTweet = new Tweet({
                        user_name: dataJSON[i].user_name,
                        profile_image: dataJSON[i].profile_image,
                        tweet_text: dataJSON[i].tweet_text,
                        create_date: dataJSON[i].create_date
                    });

                    currentTweets.add(newTweet);
                }
                var tweetcard = new TweetCard();
                tweetcard.collection = currentTweets;
                tweetcard.render();
            }

        });
    },
    //With the binding of the search view to the html,
    //the searches are then displayed for the user by using the underscore template
    render: function(){
        _.templateSettings.variable = "rc";

        var template = _.template(
            $( "#searchtemplate" ).html()
        );
        $("#old-searches").empty();
        searches.each(function(model){
            var templateData = ({
                search: model.get('term')
            });
            $( "#old-searches" ).prepend(
                "<p>"+template( templateData )+"</p>"
            );
        });
    }
});

//A global view object to use for setting the searchViewobj
var searchViewObj = new SearchView();

//
//These are defaulted to run on ready
//
// When the user types in the search input the data will get pulled once 
// the enter button is selected and the data will be in a POST request to
// the REST server where it will get the tweet data
$(document).ready(function() {
    var search = $('input[type=text]');
    search.keypress(function(ev) {
        if (ev.which === 13) {
            var newSearch = new Search({
                term: search.val()
            });
            searches.add(newSearch);
            searchViewObj.render();
            $("#tweets").empty();
            
            $.ajax("/api/search", {
                data: {terms: $(search).val()},
                success: function(data) {
                    var currentTweets = new Tweets();
//                    console.log(data);
                    var dataJSON = JSON.parse(data);
                    for(var i = 0 ; i < dataJSON.length; i++)
                    {
                        // console.log(dataJSON[i].user_name);
                        // console.log(dataJSON[i].profile_image);
                        // console.log(dataJSON[i].tweet_text);
                        // console.log(dataJSON[i].create_date);

                        // A new Tweet is created and is given new data
                        var newTweet = new Tweet({
                            user_name: dataJSON[i].user_name,
                            profile_image: dataJSON[i].profile_image,
                            tweet_text: dataJSON[i].tweet_text,
                            create_date: dataJSON[i].create_date
                        });

                        currentTweets.add(newTweet);
                    }
                    var tweetcard = new TweetCard();
                    tweetcard.collection = currentTweets;
                    tweetcard.render();
                    
                    
                }
            });
            $("#searchinput").val('');
        }
    });
    //Sets the timer interval for a refresh of the tweets for 30 seconds
    this.timer = setInterval(function() {
        searchViewObj.fetchData();
    }, 30000);

    //Places a watcher on the refresh button and if clicked then
    //it will fetch new data if there is any.
    var refresh = $("#refresh-btn").click(function() {
        searchViewObj.fetchData();
    });
});
