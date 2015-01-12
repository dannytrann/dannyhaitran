
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    {accordion}
    <div class="panel panel-default ">
        <div class="panel-heading accordion-heading" role="tab" id="headingOne">
            <h4 class="panel-title ">
                <a data-toggle="collapse" class="content-name" data-parent="#accordion" href="#{id}" aria-expanded="true" aria-controls="collapseOne">
                    <img src="/assets/images/{logo}"<p class="small-black">{name}</p>
                </a>
            </h4>
        </div>
        <div id="{id}" class="horizontal-scroll panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
                <div class="content-description col-md-4">
                    {description}
                    <a href="{link}">{link}</a>
                </div>
                <div class="col-xs-12 col-md-8 project-images">
                    {images}
                    <image class="project-image" src="data/projects/{image}">
                    {/images}
                </div>
            </div>

        </div>
    </div>
    {/accordion}
</div>