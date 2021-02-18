<div class="card-body">


        <div class="card-head">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#first1">Dados Pessoais</a></li>
                <li><a href="#second1">Permissões</a></li>

            </ul>
        </div><!--end .card-head -->
        <div class="card-body tab-content">
            <div class="tab-pane active" id="first1">

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label for="name" class="col-md-2 control-label">Nome.: *</label>
                    <div class="col-md-10">
                        <input class="form-control input-sm" name="name" type="text" id="name" value="{{ old('name', isset($user->name) ? $user->name : null) }}" maxlength="100" placeholder="Nome">
                        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" class="col-md-2 control-label">email.: *</label>
                    <div class="col-md-10">
                        <input class="form-control input-sm" name="email" type="text" id="email" value="{{ old('email', isset($user->email) ? $user->email : null) }}" maxlength="100" placeholder="Email">
                        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>


                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" class="col-md-2 control-label">Senha.: *</label>
                    <div class="col-md-10">
                        <input class="form-control input-sm" name="password" type="password" id="password" value="" maxlength="100" placeholder="Senha">
                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>



                <div class="form-group {{ $errors->has('franquia_id') ? 'has-error' : '' }}">
                    <label for="franquia_id" class="col-md-2 control-label">Franquia.: *</label>
                    <div class="col-md-10">
                        <select class="form-control input-sm" id="franquia_id" name="franquia_id">
                            <option value="" style="display: none;" {{ old('$user->roles[0]->id', null) }} disabled selected>Selecione uma Franquia</option>
                            @foreach ($franquias as $key => $franquia)
                                <option value="{{ $key }}" {{ old('franquia_id', isset($user->franquia->id) ? $user->franquia->id : null) == $key ? 'selected' : '' }}>
                                    {{ $franquia }}
                                </option>
                            @endforeach
                        </select>

                        {!! $errors->first('franquia_id', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                    <label for="role" class="col-md-2 control-label">Grupo.: *</label>
                    <div class="col-md-10">
                        <select class="form-control input-sm" id="role_id" name="role">
                            <option value="" style="display: none;" {{ old('$user->roles[0]->id', null) }} disabled selected>Selecione uma Permissão</option>
                            @foreach ($roles as $key => $role)
                                <option value="{{ $key }}" {{ old('role', isset($user->roles[0]->id) ? $user->roles[0]->id : null) == $key ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>

                        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group {{ $errors->has('is_tecnico') ? 'has-error' : '' }}">
                    <label for="is_tecnico" class="col-md-2 control-label text-bold">Técnico?.:</label>
                    <div class="col-md-10">
                        <div class="checkbox checkbox-styled">
                            <label for="is_tecnico">
                                <input id="is_tecnico" class="" name="is_tecnico" type="checkbox" value="1" {{ old('is_tecnico', isset($user->is_tecnico) ? $user->is_tecnico : null) == '1' ? 'checked' : '' }}>
                                Sim
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
                    <label for="is_active" class="col-md-2 control-label text-bold">Ativo?.:</label>
                    <div class="col-md-10">
                        <div class="checkbox checkbox-styled">
                            <label for="is_active">
                                <input id="is_active" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', isset($user->is_active) ? $user->is_active : null) == '1' ? 'checked' : '' }}>
                                Sim
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="second1">
                <div class='form-group'>
                    @foreach ($permissions as $permission)
                        <input id="permissions" class="" name="permissions[]" type="checkbox" value="{{ $permission->id  }}"  {{ in_array($permission->id, $userPermissions) ? 'checked' : '' }}>
                        {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
                    @endforeach
                </div>

            </div>

        </div><!--end .card-body -->








</div>
