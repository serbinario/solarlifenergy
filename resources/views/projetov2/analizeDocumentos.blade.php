

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="cpf_cnh_rg" class="col-sm-8 control-label text-bold">CPF/RG.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="cpf_cnh_rg">
                        <input id="cpf_cnh_rg" class="" name="cpf_cnh_rg" type="checkbox" value="1" {{ old('cpf_cnh_rg', isset($projetov2->ProjetosDocumento->cpf_cnh_rg) ? $projetov2->ProjetosDocumento->cpf_cnh_rg : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="cpf_cnh_rg_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="cpf_cnh_rg_image" type="file" id="cpf_cnh_rg_image" value="{{ old('cpf_cnh_rg_image', isset($projetov2->ProjetosDocumento->cpf_cnh_rg_image) ? $projetov2->ProjetosDocumento->cpf_cnh_rg_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->cpf_cnh_rg_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->cpf_cnh_rg_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
            @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="conprovante_residencia" class="col-sm-8 control-label text-bold">Comprovante Residência.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="conprovante_residencia">
                        <input id="conprovante_residencia" class="" name="conprovante_residencia" type="checkbox" value="1" {{ old('conprovante_residencia', isset($projetov2->ProjetosDocumento->conprovante_residencia) ? $projetov2->ProjetosDocumento->conprovante_residencia : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="conprovante_residencia_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="conprovante_residencia_image" type="file" id="conprovante_residencia_image" value="{{ old('conprovante_residencia_image', isset($projetov2->ProjetosDocumento->conprovante_residencia_image) ? $projetov2->ProjetosDocumento->conprovante_residencia_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->conprovante_residencia_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->conprovante_residencia_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="cpf_cnh_rg_conjugue" class="col-sm-8 control-label text-bold">CPF/CNH/RG Conjugue.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="cpf_cnh_rg_conjugue">
                        <input id="cpf_cnh_rg_conjugue" class="" name="cpf_cnh_rg_conjugue" type="checkbox" value="1" {{ old('cpf_cnh_rg_conjugue', isset($projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue) ? $projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="cpf_cnh_rg_conjugue_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="cpf_cnh_rg_conjugue_image" type="file" id="cpf_cnh_rg_conjugue_image" value="{{ old('cpf_cnh_rg_conjugue_image', isset($projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image) ? $projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->cpf_cnh_rg_conjugue_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>
            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="certidao_casamento" class="col-sm-8 control-label text-bold">Certidão de Casamento.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="certidao_casamento">
                        <input id="certidao_casamento" class="" name="certidao_casamento" type="checkbox" value="1" {{ old('certidao_casamento', isset($projetov2->ProjetosDocumento->certidao_casamento) ? $projetov2->ProjetosDocumento->certidao_casamento : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="certidao_casamento_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="certidao_casamento_image" type="file" id="certidao_casamento_image" value="{{ old('certidao_casamento_image', isset($projetov2->ProjetosDocumento->certidao_casamento_image) ? $projetov2->ProjetosDocumento->certidao_casamento_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->certidao_casamento_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->certidao_casamento_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="certidao_casamento" class="col-sm-8 control-label text-bold">Ficha de Elaboração Assinada?.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="ficha_elaboracao_projeto">
                        <input id="ficha_elaboracao_projeto" class="" name="ficha_elaboracao_projeto" type="checkbox" value="1" {{ old('ficha_elaboracao_projeto', isset($projetov2->ProjetosDocumento->ficha_elaboracao_projeto) ? $projetov2->ProjetosDocumento->ficha_elaboracao_projeto : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="ficha_elaboracao_projeto_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="ficha_elaboracao_projeto_image" type="file" id="ficha_elaboracao_projeto_image" value="{{ old('ficha_elaboracao_projeto_image', isset($projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image) ? $projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->ficha_elaboracao_projeto_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="certidao_casamento" class="col-sm-8 control-label text-bold">Declaração de Ciência Assinada?.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="declaracao_ciencia">
                        <input id="declaracao_ciencia" class="" name="declaracao_ciencia" type="checkbox" value="1" {{ old('declaracao_ciencia', isset($projetov2->ProjetosDocumento->declaracao_ciencia) ? $projetov2->ProjetosDocumento->declaracao_ciencia : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="declaracao_ciencia_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="declaracao_ciencia_image" type="file" id="declaracao_ciencia_image">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->declaracao_ciencia_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->declaracao_ciencia_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="proposta" class="col-sm-8 control-label text-bold">Proposta Assinada?.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="proposta">
                        <input id="proposta" class="" name="proposta" type="checkbox" value="1" {{ old('proposta', isset($projetov2->ProjetosDocumento->proposta) ? $projetov2->ProjetosDocumento->proposta : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="proposta_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="proposta_image" type="file" id="proposta_image" value="{{ old('proposta_image', isset($projetov2->ProjetosDocumento->proposta_image) ? $projetov2->ProjetosDocumento->proposta_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->proposta_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->proposta_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

            @endif

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label for="contrato" class="col-sm-8 control-label text-bold">Contrato Assinado?.:</label>
            <div class="col-md-4">
                <div class="checkbox checkbox-styled">
                    <label for="contrato">
                        <input id="contrato" class="" name="contrato" type="checkbox" value="1" {{ old('ficha_elaboracao_projeto', isset($projetov2->ProjetosDocumento->contrato) ? $projetov2->ProjetosDocumento->contrato : null) == '1' ? 'checked' : '' }}>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label for="contrato_image" class="col-sm-3 control-label text-bold">Documento.:</label>
            <div class="col-md-9">
                <input class="form-control input-sm" name="contrato_image" type="file" id="contrato_image" value="{{ old('contrato_image', isset($projetov2->ProjetosDocumento->contrato_image) ? $projetov2->ProjetosDocumento->contrato_image : "") }}">
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            @if($projetov2->ProjetosDocumento->contrato_image)
                <a target="_blank" href="{{ url("/storage/{$projetov2->ProjetosDocumento->contrato_image}") }}" class="btn btn-info btn-sm" role="button">Link Arquivo</a>

            @endif

        </div>
    </div>
</div>


