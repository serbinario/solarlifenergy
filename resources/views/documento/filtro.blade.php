<!--Accordion -->
<div class="col-md-12">
    <div class="panel-group" id="accordion">
        <div class="card panel">
            <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-1">
                <header>Filtro</header>
                <div class="tools">
                    <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div id="accordion7-1" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nome" class="col-sm-3 control-label">Documento:</label>
                                <div class="col-md-9">
                                    <input class="form-control input-sm" name="documento" type="text" id="documento" maxlength="20" placeholder="documento">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <label for="franquia_id" class="col-md-4 control-label">Franquia</label>
                            <div class="col-md-8">
                                <select   class="form-control input-sm" id="franquia_id" name="franquia_id">
                                    <option value="" style="display: none;" {{ old('id', isset($franquia->id) ? $franquia->id : '') == '' ? 'selected' : '' }} disabled selected>Franquias</option>
                                    @foreach ($franquias as $key => $franquia)
                                        <option value="{{ $key }}" {{ old('meio_captacao_id', isset($franquia->id) ? $franquia->id : null) == $key ? 'selected' : '' }}>
                                            {{ $franquia }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="col-md-8">
                                    <a href="#" type="button" id="localizar" class="btn btn-sm btn-flat btn-primary ink-reaction">Localizar</a>
                                    <input class="btn btn-sm btn-primary"  id="limpar" type="button" value="Limpar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end .panel -->
    </div><!--end .panel-group -->