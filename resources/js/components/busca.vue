<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col sm">
                    <div class="card">
                    <div class="card-header">Buscar por CEP</div>
                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="cep">CEP</label>
                                <input  type="number" class="form-control" id="cep" placeholder="Informe o cep" required v-model='cep'>
                           </div> 
                                <button type="button" class="btn btn-success" @click="getListaCep()">Pesquisar</button> 
                        </div>
                    </div>
                </div>
                <div class="col sm">
                    <div class="card">
                        <div class="card-header">Buscar por Logradouro</div>
                            <div class="card-body">
                                <div class="form-group">                                    
                                    <label for="cep">UF</label>
                                    <input type="text" class="form-control" id="uf" placeholder="Informe o uf" required v-model='uf'>
                                    <label for="cep">CIDADE</label>
                                    <input type="text" class="form-control" id="cidade" placeholder="Informe a cidade" required v-model='cidade'>
                                    
                                    <label for="logradouro">Logradouro</label>
                                    <input type="text" class="form-control" id="logradouro" placeholder="Informe o endereço" required v-model='logra'>                           
                                                                              
                                </div> 
                                <button type="button" class="btn btn-success" @click="getLista()">Pesquisar</button>    
                            </div>                 
                        </div>                    
                    </div>
                    
                </div>
        </div>
    </div>
                <div class="card">                
                    <div class="card-header">Lista dos registros salvos local e viacep.com.br</div>
                    <div class="card-body">
                        <table class="table" table-hover>
                            <thead>
                                    <tr>
                                    <th scope="col">CEP</th>
                                    <th scope="col">UF</th>
                                    <th scope="col">CIDADE</th>
                                    <th scope="col">LOGRADOURO</th>                                
                                    </tr>
                                </thead>
                            <tbody>
                                <tr v-for="m in lista" :key="m.id">
                                    <th scope="row"{{m.cep}}</th>
                                    <td>{{m.cep}}</td>
                                    <td>{{m.uf}}</td>
                                    <td>{{m.localidade}}</td>
                                    <td>{{m.logradouro}}</td>                                    
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
        urlBase: 'http://127.0.0.1:8000/api/logra/', 
        urlBaseCep: 'http://127.0.0.1:8000/api/search/',      
        lista: [],
        cep: '',
        uf: '',
        cidade: '',
        logra: ''    
      }
    },
       methods: {
    getLista(){
       axios.get(this.urlBase + this.uf+'/' + this.cidade+'/' + this.logra)
        .then(response =>{
            this.lista = response.data
            console.log(response)
        })
        .catch(errors => {                   
            console.log(errors);
        })
       },       
    getListaCep(){
       axios.get(this.urlBaseCep + this.cep)
        .then(response =>{
            this.lista = response.data
            console.log(response)
        })
        .catch(errors => {                 
            console.log(errors);
        })
       }
    }
    
    
  } 
</script>
