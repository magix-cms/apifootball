{extends file="layout.tpl"}
{block name='head:title'}Api Football{/block}
{block name='body:id'}apifootball{/block}
{block name='article:header'}
    <h1 class="h2">Api Football</h1>
{/block}
{block name='article:content'}
    {if {employee_access type="view" class_name=$cClass} eq 1}
        <div class="panels row">
            <section class="panel col-ph-12">
                {if $debug}
                    {$debug}
                {/if}
                <header class="panel-header">
                    <h2 class="panel-heading h5">Gestion Api Football</h2>
                </header>
                <div class="panel-body panel-body-form">
                    <div class="mc-message-container clearfix">
                        <div class="mc-message"></div>
                    </div>

                    <div class="row">
                        <form id="apifootball_config" action="{$smarty.server.SCRIPT_NAME}?controller={$smarty.get.controller}&amp;action=edit" method="post" class="validate_form edit_form col-ph-12 col-md-6">
                            <div class="row">
                                <div class="col-ph-12 col-md-6">
                                    <div class="form-group">
                                        <label for="url_apifb">URL :</label>
                                        <input type="text" class="form-control" id="url_apifb" name="apifbData[url_apifb]" value="{$apifb.url_apifb}" size="50" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-ph-12 col-md-6">
                                    <div class="form-group">
                                        <label for="key_apifb">API Key :</label>
                                        <input type="text" class="form-control" id="key_apifb" name="apifbData[key_apifb]" value="{$apifb.key_apifb}" size="50" />
                                    </div>
                                </div>
                            </div>
                            <div id="submit">
                                <button class="btn btn-main-theme pull-right" type="submit" name="action" value="edit">{#save#|ucfirst}</button>
                                {*<button class="btn btn-main-theme pull-right" type="button" id="testApi" name="testApi" value="test">Test</button>*}
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    {else}
        {include file="section/brick/viewperms.tpl"}
    {/if}
{/block}