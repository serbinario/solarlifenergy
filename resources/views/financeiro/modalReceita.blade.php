
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalReceita" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-head style-primary">
                <header>Nova receita</header>
            </div>
            <form name="modalReceita" class="form">
                    <div class="card-body floating-label">

                        <div class="form-group">
                            <input name="description" type="text" class="form-control input-sm" id="Username2">
                            <label for="description">Descrição</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input  name="projeto_id" type="text" class="input-sm form-control" id="Lastname2">
                                    <label for="projeto_id">Código Projeto</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input name="valor" type="text"  class="money input-sm form-control" id="Firstname2">
                                    <label  for="valor">Valor</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input  name="data_vencimento" type="text" class="date input-sm form-control" id="Lastname2">
                                    <label class="" for="data_vencimento">Data</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select id="conta" name="conta" class="form-control input-sm contas">
                                        <option value="">&nbsp;</option>
                                    </select>
                                    <label for="conta">Conta</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select id="category-receitas" name="category" class="form-control input-sm ">
                                        <option value="">&nbsp;</option>
                                    </select>
                                    <label class="" for="category">Categoria</label>
                                </div>
                            </div>
                        </div>

                        <div id="repeat" class="row lancamentos-repeat">
                            <span>Repetir: é um lançamento parcelado em</span>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="number" name="qtd_parcelas" class="input-sm form-control number" id="Firstname2">
                                    <label  for="Firstname2">Quantidade</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select id="periodo" name="periodo" class="form-control input-sm">
                                        <option value="1">Mensal</option>
                                        <option value="2">Semanal</option>
                                    </select>
                                    <label class="" for="periodo">Periodo</label>
                                </div>
                            </div>
                        </div>

                        <div id="note" class="form-group lancamentos-note">
                            <textarea name="lancamento_obs" id="textarea1" class="form-control input-sm" rows="2" placeholder=""></textarea>
                            <label for="lancamento_obs">Observação</label>
                        </div>

                        <div class="form-group receita-tags">
                            <div>
                                <button id="btn-repeat" type="button" class="btn ink-reaction btn-floating-action btn-primary"><i class="fa fa-repeat"></i></button>
                                <label  for="textarea1">Repetir</label>
                            </div>
                            <div>
                                <button id="btn-note" type="button" class="btn ink-reaction btn-floating-action btn-primary"><i class="fa fa-comments-o"></i></button>
                                <label  for="textarea1">Observação</label>
                            </div>
                            <div>
                                <button type="button" class="btn ink-reaction btn-floating-action btn-primary"><i class="fa fa-paperclip"></i></button>
                                <label id="atach" for="textarea1">Anexo</label>
                            </div>
                        </div>


                    </div><!--end .card-body -->
                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <button type="submit" class="btn ink-reaction btn-floating-action btn-lg btn-primary btn-save-receita" data-toggle="dropdown" data-loading-text="<i class='fa fa-spinner fa-spin'></i>"><i class="fa fa-check"></i></button>

                        </div>
                    </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->