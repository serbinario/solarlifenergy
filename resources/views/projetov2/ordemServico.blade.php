<div class="row">
    <div class="col-md-12"> <!-- Início do col-md-12 -->

        <div class="row">
            <table  class="table no-margin listaOrdemServico" border="0" style="padding-left:50px;">
                <tr>
                    <th>Código</th>
                    <th>Data Cadatro</th>
                    <th>Data Visita</th>
                    <th>Tipo</th>
                    <th>Status</th>
                </tr>
            </table>

        </div>

        <div class="card-actionbar">
            <div class="card-actionbar-row">
                <a type="button" onclick="criarOsInstalacao({{ $projetov2->id }})" class="btn btn-primary">Criar o.s. instalação</a>
                <a type="button" onclick="criarOsCorretiva({{ $projetov2->id }})" class="btn btn-primary">Criar o.s. Corretiva</a>
                <a type="button" onclick="criarOsPreventiva({{ $projetov2->id }})" class="btn btn-primary">Criar o.s. Preventiva</a>
            </div>
        </div>
    </div> <!-- Fim do col-md-12 -->
</div>

