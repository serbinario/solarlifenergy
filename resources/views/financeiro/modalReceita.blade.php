
<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="formModalReceita" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-head style-primary">
                <header>Nova Receita</header>
            </div>
            <form class="form">
                    <div class="card-body floating-label">

                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="Username2">
                            <label for="Username2">Descrição</label>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text"  class="input-sm form-control" id="Firstname2">
                                    <label  for="Firstname2">Valor</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input  type="text" class="date input-sm form-control" id="Lastname2">
                                    <label class="" for="Lastname2">Data</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select id="select1" name="select1" class="form-control input-sm ">
                                        <option value="">&nbsp;</option>
                                        <option value="30">BB</option>
                                        <option value="30">Bradesco</option>
                                    </select>
                                    <label for="Firstname2">Conta</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select id="select1" name="select1" class="form-control input-sm ">
                                        <option value="">&nbsp;</option>
                                        <option value="30">Alimentação</option>
                                        <option value="30">Combustível</option>
                                    </select>
                                    <label class="" for="Lastname2">Categoria</label>
                                </div>
                            </div>
                        </div>

                        <div id="repeat" class="row">
                            <span>Repetir: é um lançamento parcelado em</span>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="number"  class="input-sm form-control number" id="Firstname2">
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

                        <div id="note" class="form-group">
                            <textarea name="textarea1" id="textarea1" class="form-control input-sm" rows="2" placeholder=""></textarea>
                            <label for="textarea1">Observação</label>
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
                            <button type="submit" class="btn btn-flat btn-primary ink-reaction">Salvar</button>
                        </div>
                    </div>




            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->