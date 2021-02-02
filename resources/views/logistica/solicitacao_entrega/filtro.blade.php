<!--Accordion -->
<div class="col-md-12">
    <div class="panel-group" id="accordion8">
        <div class="card panel">
            <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion8" data-target="#accordion8-1">
                <header>Filtro</header>
                <div class="tools">
                    <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                </div>
            </div>
            <div id="accordion8-1" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="nome" class="col-sm-2 control-label">Cliente:</label>
                                <div class="col-md-10">
                                    <input class="form-control input-sm" name="nome" type="text" id="nome" maxlength="20" placeholder="Nome">
                                </div>
                            </div>
                        </div>



                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="franquia_id" class="col-md-2 control-label">Status.: *</label>
                                <div class="col-md-10">
                                    <select   class="form-control input-sm" id="status_visita_id" name="status_visita_id">
                                        <option value="" style="display: none;" {{ old('status_visita_id', isset($visitaTecnica->status_visita_id) ? $visitaTecnica->status_visita_id : '') == '' ? 'selected' : '' }} disabled selected>Status</option>
                                        @foreach ($status as $key => $statu)
                                            <option value="{{ $key }}" {{ old('status_visita_id', isset($visitaTecnica->status_visita_id) ? $visitaTecnica->status_visita_id : null) == $key ? 'selected' : '' }}>
                                                {{ $statu }}
                                            </option>
                                        @endforeach
                                    </select>

                                    {!! $errors->first('franquia_id', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
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
</div>