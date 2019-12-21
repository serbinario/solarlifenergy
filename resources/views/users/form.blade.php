<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Pessoais</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>


    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="name" class="col-md-2 control-label">Nome</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="name" type="text" id="name" value="{{ old('name', isset($user->name) ? $user->name : null) }}" maxlength="100" placeholder="Nome">
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="email" class="col-md-2 control-label">email</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="email" type="text" id="email" value="{{ old('email', isset($user->email) ? $user->email : null) }}" maxlength="100" placeholder="Email">
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label for="password" class="col-md-2 control-label">Senha</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="password" type="password" id="password" value="" maxlength="100" placeholder="Email">
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('clientes_id') ? 'has-error' : '' }}">
        <label for="role" class="col-md-2 control-label">Permissao</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="role" name="role">
                <option value="" style="display: none;" {{ old('$user->roles[0]->id', null) }} disabled selected>Select clientes</option>
                @foreach ($roles as $key => $role)
                    <option value="{{ $key }}" {{ old('role', isset($user->roles[0]->id) ? $user->roles[0]->id : null) == $key ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('clientes_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


</div>
