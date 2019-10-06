<template>
    <div class="container">
    
        <div class="row justify-content-center">
    
            <div class="col-md-11">
    
                <div class="card">
    
                    <div class="card-header">
    
                        Usuarios
    
                        <div class="card-tools">
    
                            <router-link to="/user" class="btn btn-success">Nuevo <i class="fas fa-user-plus fa-fw"></i></router-link>
    
                        </div>
    
                    </div>
    
                    <div class="card-body table-responsive p-0">
    
                        <table class="table table-hover">
    
                            <thead>
    
                                <tr>
    
                                    <th>ID</th>
    
                                    <th>Nombre</th>
    
                                    <th>Correo</th>
    
                                    <th>Creacion</th>
    
                                    <th>Acciones</th>
    
                                </tr>
    
                            </thead>
    
                            <tbody>
    
                                <tr>
    
                                    <td>183</td>
    
                                    <td>John Doe</td>
    
                                    <td>acar@gmail.com</td>
    
                                    <td>11-7-2014</td>
    
                                    <td><a href=""><i class="fas fa-edit"></i></a> / <a href=""><i class="fas fa-trash"></i></a> </td>
    
                                </tr>
    
                            </tbody>
    
                        </table>
    
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
    </div>
</template>


