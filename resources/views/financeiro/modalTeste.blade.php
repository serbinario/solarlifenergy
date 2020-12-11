
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="teste" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-head style-primary">
                <header>Nova despesa</header>
            </div>
            <form name="modalDespesa" class="form">
                <div class="card-body floating-label">


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
                                    <input name="description" autocomplete="false" type="search" class="form-control input-sm" id="Username2">
                                    <label for="description">Categoria</label>
                                </div>
                                <div class="zze-component_popover bottom white">
                                    <div class="zze-popover-padding">
                                        <div class="arrow"></div>
                                        <div class="popover-content">
                                            <ul class="zze-popover-options ng-scope">
                                                <li><a ng-click="transactions.setCategory()" ng-class="{active: transactions.model.categories.length == 0}" href="" class="" style=""><span class="zze-text-option ng-scope" translate="">Todas categorias</span></a></li>
                                                <!-- ngIf: !transactions.isFixedCategories() --><!-- ngIf: transactions.isFixedCategories() -->
                                                <div ng-if="transactions.isFixedCategories()" class="ng-scope">
                                                    <li class="zze-filter-subtitle"><a><span class="zze-text-option ng-binding">Categorias de despesa</span></a></li>
                                                    <!-- ngRepeat: item in transactions.getExpensesCategories() -->
                                                    <li ng-repeat="item in transactions.getExpensesCategories()" class="ng-scope">
                                                        <a ng-click="transactions.setCategory(item)" ng-class="{active: transactions.checkCategorySelected(item.uuid)}" href=""><span class="zze-text-option ng-binding">Alimentação</span></a><!-- ngIf: item.children.length != 0 -->
                                                        <ul ng-if="item.children.length != 0" class="zze-popover-children ng-scope">
                                                            <!-- ngRepeat: child in item.children -->
                                                        </ul>
                                                        <!-- end ngIf: item.children.length != 0 -->
                                                    </li>
                                                    <!-- end ngRepeat: item in transactions.getExpensesCategories() -->
                                                    <li ng-repeat="item in transactions.getExpensesCategories()" class="ng-scope">
                                                        <a ng-click="transactions.setCategory(item)" ng-class="{active: transactions.checkCategorySelected(item.uuid)}" href="" class="active" style=""><span class="zze-text-option ng-binding">Assinaturas e serviços</span></a><!-- ngIf: item.children.length != 0 -->
                                                        <ul ng-if="item.children.length != 0" class="zze-popover-children ng-scope">
                                                            <!-- ngRepeat: child in item.children -->
                                                            <li ng-repeat="child in item.children" class="ng-scope"><a ng-click="transactions.setCategory(child)" ng-class="{active: transactions.checkCategorySelected(child.uuid)}" href="" class="active" style=""><span class="zze-text-option ng-binding">teste</span></a></li>
                                                            <!-- end ngRepeat: child in item.children -->
                                                        </ul>
                                                        <!-- end ngIf: item.children.length != 0 -->
                                                    </li>
                                                    <!-- end ngRepeat: item in transactions.getExpensesCategories() -->
                                                    <li ng-repeat="item in transactions.getExpensesCategories()" class="ng-scope">
                                                        <a ng-click="transactions.setCategory(item)" ng-class="{active: transactions.checkCategorySelected(item.uuid)}" href=""><span class="zze-text-option ng-binding">Bares e restaurantes</span></a><!-- ngIf: item.children.length != 0 -->
                                                        <ul ng-if="item.children.length != 0" class="zze-popover-children ng-scope">

                                                        </ul>

                                                    </li>

                                                    <li class="divider"></li>
                                                    <li class="zze-filter-subtitle"><a><span class="zze-text-option ng-binding">Categorias de receita</span></a></li>
                                                    <!-- ngRepeat: item in transactions.getEarningsCategories() -->
                                                    <li ng-repeat="item in transactions.getEarningsCategories()" class="ng-scope">
                                                        <span class="zze-text-option ng-binding">Empréstimos</span>
                                                        <ul ng-if="item.children.length != 0" class="zze-popover-children ng-scope">
                                                            <!-- ngRepeat: child in item.children -->
                                                        </ul>
                                                        <!-- end ngIf: item.children.length != 0 -->
                                                    </li>

                                                </div>
                                                <!-- end ngIf: transactions.isFixedCategories() -->
                                            </ul>
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