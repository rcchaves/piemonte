<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastro</div>
                        
                        <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso" v-if="transacaoStatus == 'adicionado'"></alert-component>
                        <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar o cep" v-if="transacaoStatus == 'erro'"></alert-component>
                 
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="col-sm">
                                    <div class="form-group">                                    
                                        <label for="cep">CEP</label>
                                        <input type="number" class="form-control" id="cep" aria-describedby="cep" placeholder="Informe o cep" required v-model='cep'>
                                        <small id="cep" class="form-text text-muted">Informe o cep</small>
                                        <label for="uf">UF</label>
                                        <input type="text" maxlength="2" class="form-control" id="uf" aria-describedby="uf" placeholder="Informe o Estado" required v-model='uf'>
                                        <small id="uf" class="form-text text-muted">Informe o Estado</small>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="localidade">CIDADE</label>
                                        <input type="text" class="form-control" id="localidade" aria-describedby="localidade" placeholder="Informe a Cidade" required v-model='localidade'>
                                        <small id="localidade" class="form-text text-muted">Informe a Cidade</small>
                                        <label for="logradouro">LOGRADOURO</label>
                                        <input type="text" class="form-control" id="logradouro" aria-describedby="logradouro" placeholder="Informe o endereço" required v-model='logradouro'>
                                        <small id="logradouro" class="form-text text-muted">Informe o endereço</small>                                        
                                    </div>
                                </div>                                 
                            </div>                               
                        </form>
                    </div>
                     <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm" @click="salvar()">Salvar</button>            
                                </div>
                </div>
                <div class="card">
                   <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Excluido com sucesso" v-if="transacaoStatus == 'excluido'"></alert-component>
                        <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar excluir" v-if="transacaoStatus == 'error'"></alert-component>

                    <div class="card-header">Lista dos registros salvos local</div>
                    <div class="card-body">
                        <table class="table" table-hover>
                            <thead>
                                    <tr>
                                    <th scope="col">CEP</th>
                                    <th scope="col">UF</th>
                                    <th scope="col">CIDADE</th>
                                    <th scope="col">LOGRADOURO</th>
                                    <th scope="col">AÇOES</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr v-for="m in lista" :key="m.id">
                                    <th scope="row"{{m.cep}}</th>
                                    <td>{{m.cep}}</td>
                                    <td>{{m.uf}}</td>
                                    <td>{{m.localidade}}</td>
                                    <td>{{m.logradouro}}</td>
                                    <td><button type="button" class="btn btn-danger btn-sm" @click="remover(m)">Excluir</button></td>
                                </tr>                                            
                            </tbody>
                        </table>
                    </div>                            
                </div>                                            
            </div>                
        </div>
    </div>
</div>
</template>

<script>
    export default {
       
         data() {
      return {
        urlBase: 'http://127.0.0.1:8000/api/inicio',     
        lista: [],
        cep: '',
        uf: '',
        localidade: '',
        logradouro: '',
        id: '',
        transacaoStatus: '',
        transacaoDetalhes: {}
      }
    },
       methods: {
      
    getLista(){
       axios.get(this.urlBase)
        .then(response =>{
            this.lista = response.data
            console.log(response)
        })
        .catch(errors => {
            console.log(errors);
        })
       },
       salvar(){      
                let formData = new FormData();
                formData.append('cep', this.cep)
                formData.append('uf', this.uf)
                formData.append('localidade', this.localidade)
                formData.append('logradouro', this.logradouro)
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
       axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = 'adicionado'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + response.data.id 
                        } 
                      this.formData = '';    
                      this.getLista()           
                        console.log(response)
                                             
                    })
                    .catch(errors => {
                        this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }                 
                        console.log(response) 
                    })
    },
    remover(m) {  
        let confirmacao = confirm('Tem certeza que deseja remover esse registro?')

                if(!confirmacao) {
                    return false;
                }      
        let formData = new FormData();
        formData.append('_method', 'delete')

        let url = this.urlBase + '/' + this.lista[0].id

        axios.post(url, formData)
            .then(response => {
               this.transacaoStatus = 'excluido'
                        this.transacaoDetalhes = {
                            mensagem: 'ID do registro: ' + this.lista[0].id
                        } 
                this.getLista()
            })
            .catch(errors => {
                this.transacaoStatus = 'erro'
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                        }                 
                
                
            })

    },  
    },
    mounted() {
            this.getLista()
        }  
    
    
  }
       
        
    
</script>
