
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="teste" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-head style-primary">
                <header>Nova despesa</header>
            </div>
            <form name="modalDespesa" class="form">
                <div class="card-body ">


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <select id="contaDespesas" name="conta" class="form-control input-sm contas">
                                    <option value="">&nbsp;</option>
                                </select>
                                <label for="conta">Conta</label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="zze-bar-popover">
                                <div class="form-group">
                                    <input data-category-value="" name="category" autocomplete="false" type="search" class="form-control input-sm" id="Username2">
                                    <label for="description">Categoria</label>
                                    <div class="zze-component_popover bottom white">
                                        <div class="zze-popover-padding">
                                            <div class="arrow"></div>
                                            <div class="popover-content">
                                                <ul class="zze-popover-options ng-scope">
                                                    <li onclick="handleCategory(event)" data-value="9">Folha</li>
                                                    <li onclick="handleCategory(event)" data-value="10">Impostos</li>
                                                    <ul data-group="10">
                                                        <li onclick="handleCategory(event)" data-value="11" ng-repeat="child in item.children" class="ng-scope">
                                                            INSS
                                                        </li>
                                                    </ul>
                                                    <ul data-group="11">
                                                        <li onclick="handleCategory(event)" data-value="13" ng-repeat="child in item.children" class="ng-scope">
                                                            FGTS
                                                        </li>
                                                    </ul>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>









        </div><!--end .card-body -->
        <div class="card-actionbar">
            <div class="card-actionbar-row">
                <button type="submit" class="btn ink-reaction btn-floating-action btn-lg btn-primary btn-save-despesa" data-toggle="dropdown" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>

            </div>
        </div>



        </form>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->