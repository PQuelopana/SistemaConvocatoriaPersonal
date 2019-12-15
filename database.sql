/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  chorrillos
 * Created: 14/12/2019
 */

Create DataBase If Not Exists SistConvPersonal;

Use SistConvPersonal;

Create Table FormacionAcademicaNivel(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKFormacionAcademicaNivel Primary Key(id)
)Engine=InnoDb;

Create Table FormacionAcademicaGrado(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKFormacionAcademicaGrado Primary Key(id)
)Engine=InnoDb;

Create Table FormacionAcademicaEspecialidad(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKFormacionAcademicaEspecialidad Primary Key(id)
)Engine=InnoDb;

Create Table CentroEstudio(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKCentroEstudio Primary Key(id)
)Engine=InnoDb;

Create Table TipoDocumentoIdentidad(
    id                          Int(255) Auto_Increment Not Null,
    idOficial                   VarChar(10) Not Null,
    nombre                      VarChar(255) Not Null,
    indActivo                   TinyInt Not Null,
    Constraint PKTipoDocumentoIdentidad Primary Key(id),
    Constraint UQTipoDocumentoIdentidad Unique(idOficial)
)Engine=InnoDb;

Create Table Pais(
    id                          Int(255) Auto_Increment Not Null,
    idOficial                   VarChar(10) Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKPais Primary Key(id),
    Constraint UQPais Unique(idOficial)
)Engine=InnoDb;

Create Table Departamento(
    id                          Int(255) Auto_Increment Not Null,
    idOficial                   VarChar(10) Not Null,
    idPais                      Int(255) Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKDepartamento Primary Key(id),
    Constraint UQDepartamento Unique(idOficial),
    Constraint FKDepartamento_Pais Foreign Key(idPais) References Pais(id)
)Engine=InnoDb;

Create Table Provincia(
    id                          Int(255) Auto_Increment Not Null,
    idOficial                   VarChar(10) Not Null,
    idDepartamento              Int(255) Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKProvincia Primary Key(id),
    Constraint UQProvincia Unique(idOficial),
    Constraint FKProvincia_Departamento Foreign Key(idDepartamento) References Departamento(id)
)Engine=InnoDb;

Create Table Distrito(
    id                          Int(255) Auto_Increment Not Null,
    idOficial                   VarChar(10) Not Null,
    idProvincia                 Int(255) Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKDistrito Primary Key(id),
    Constraint UQDistrito Unique(idOficial),
    Constraint FKDistrito_Provincia Foreign Key(idProvincia) References Provincia(id)
)Engine=InnoDb;

Create Table ColegioProfesional(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKColegioProfesional Primary Key(id)
)Engine=InnoDb;

Create Table Administrador(
    id                          Int(255) Auto_Increment Not Null,
    nombres                     VarChar(255) Not Null,
    apellidoPaterno             VarChar(255) Not Null,
    apellidoMaterno             VarChar(255) Not Null,
    idTipoDocumentoIdentidad    Int(255) Not Null,
    numeroDocumentoIdentidad    VarChar(25) Not Null,
    correo                      VarChar(30) Not Null,
    contraseña                  VarChar(255) Not Null,
    Constraint PKAdministrador Primary Key(id),
    Constraint UQAdministrador Unique(correo),
    Constraint FKAdministrador_TipoDocumentoIdentidad Foreign Key(idTipoDocumentoIdentidad) References TipoDocumentoIdentidad(id)
)Engine=InnoDb;

Create Table Convocatoria(
    id                          Int(255) Auto_Increment Not Null,
    idOficial                   VarChar(10) Not Null,
    nombre                      VarChar(255) Not Null,
    fechaInicio                 Date Not Null,
    fechaFin                    Date Not Null,
    estado                      Char(1) Not Null Comment '',
    idAdministradorRegistro     Int(255) Not Null,
    fechaRegistro               Date Not Null,
    horaRegistro                Time Not Null,
    ipRegistro                  VarChar(50) Not Null,
    idAdministradorModificacion Int(255) Not Null,
    fechaModificacion           Date Not Null,
    horaModificacion            Time Not Null,
    ipModificacion              VarChar(50) Not Null,
    idAdministradorEliminacion  Int(255) Not Null,
    fechaEliminacion            Date Not Null,
    horaEliminacion             Time Not Null,
    ipEliminacion               VarChar(50) Not Null,
    Constraint PKConvocatoria Primary Key(id),
    Constraint UQConvocatoria Unique(idOficial)
)Engine=InnoDb;

Create Table TipoDocumentoSustentatorio(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKTipoDocumentoSustentatorio Primary Key(id)
)Engine=InnoDb;

Create Table Cargo(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKCargo Primary Key(id)
)Engine=InnoDb;

Create Table TipoEntidad(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKTipoEntidad Primary Key(id)
)Engine=InnoDb;

Create Table ConocimientoTecnico(
    id                          Int(255) Auto_Increment Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKConocimientoTecnico Primary Key(id)
)Engine=InnoDb;

Create Table Entidad(
    id                          Int(255) Auto_Increment Not Null,
    idTipoEntidad               Int(255) Not Null,
    nombre                      VarChar(255) Not Null,
    Constraint PKEntidad Primary Key(id),
    Constraint FKEntidad_TipoEntidad Foreign Key(idTipoEntidad) References TipoEntidad(id)
)Engine=InnoDb;

Create Table Postulante(
    id                          Int(255) Auto_Increment Not Null,
    nombres                     VarChar(255) Not Null,
    apellidoPaterno             VarChar(255) Not Null,
    apellidoMaterno             VarChar(255) Not Null,
    idTipoDocumentoIdentidad    Int(255) Not Null,
    numeroDocumentoIdentidad    VarChar(25) Not Null,
    correo                      VarChar(30) Not Null,
    contraseña                  VarChar(255) Not Null,
    estadoCivil                 Char(1) Not Null Comment 'S: Soltero, C: Casado, D: Divorciado, V: Viudo',
    idDistrito                  Int(255) Not Null,
    tipoZona                    VarChar(30) Not Null,
    nombreZona                  VarChar(50) Not Null,
    tipoVia                     VarChar(30) Not Null,
    direccion                   VarChar(50) Not Null,
    telefono                    VarChar(25) Not Null,
    celular                     VarChar(25) Not Null,
    firmaElectronica            VarChar(50) Not Null,
    idColegioProfesional        Int(255) Null,
    numeroRegistro              VarChar(25) Not Null,
    indDiscapacidad             TinyInt Not Null,
    indFFAA                     TinyInt Not Null,
    indInhabilitadoEstado       TinyInt Not Null,
    indPronabec                 TinyInt Not Null,
    indPenales                  TinyInt Not Null,
    indJudiciales               TinyInt Not Null,
    indPoliciales               TinyInt Not Null,
    indEtica                    TinyInt Not Null,
    Constraint PKPostulante Primary Key(id),
    Constraint UQPostulante Unique(correo),
    Constraint FKPostulante_TipoDocumentoIdentidad Foreign Key(idTipoDocumentoIdentidad) References TipoDocumentoIdentidad(id),
    Constraint FKPostulante_Distrito Foreign Key(idDistrito) References Distrito(id),
    Constraint FKPostulante_ColegioProfesional Foreign Key(idColegioProfesional) References ColegioProfesional(id)
)Engine=InnoDb;

Create Table PostulanteFormacionAcademica(
    id                                  Int(255) Auto_Increment Not Null,
    idPostulante                        Int(255) Not Null,
    idFormacionAcademicaNivel           Int(255) Not Null,
    idFormacionAcademicaGrado           Int(255) Not Null,
    idFormacionAcademicaEspecialidad    Int(255) Not Null,
    idCentroEstudio                     Int(255) Not Null,
    annioInicio                         Int(255) Not Null,
    annioFin                            Int(255) Not Null,
    fechaExtensionGrado                 Date Not Null,
    nombreArchivoSustento               VarChar(50) Not Null,
    Constraint PKPostulanteFormacionAcademica Primary Key(id),
    Constraint UQPostulanteFormacionAcademica Unique(idPostulante, idFormacionAcademicaNivel, idFormacionAcademicaGrado, idFormacionAcademicaEspecialidad),
    Constraint FKPostulanteFormacionAcademica_Postulante Foreign Key(idPostulante) References Postulante(id),
    Constraint FKPostulanteFormacionAcademica_FormacionAcademicaNivel Foreign Key(idFormacionAcademicaNivel) References FormacionAcademicaNivel(id),
    Constraint FKPostulanteFormacionAcademica_FormacionAcademicaGrado Foreign Key(idFormacionAcademicaGrado) References FormacionAcademicaGrado(id),
    Constraint FKPostulanteFormacionAcademica_FormacionAcademicaEspecialidad Foreign Key(idFormacionAcademicaEspecialidad) References FormacionAcademicaEspecialidad(id),
    Constraint FKPostulanteFormacionAcademica_CentroEstudio Foreign Key(idCentroEstudio) References CentroEstudio(id)
)Engine=InnoDb;

Create Table PostulanteConocimientoTecnico(
    id                                  Int(255) Auto_Increment Not Null,
    idPostulante                        Int(255) Not Null,
    idConocimientoTecnico               Int(255) Not Null,
    Constraint PKPostulanteConocimientoTecnico Primary Key(id),
    Constraint UQPostulanteConocimientoTecnico Unique(idPostulante, idConocimientoTecnico),
    Constraint FKPostulanteConocimientoTecnico_Postulante Foreign Key(idPostulante) References Postulante(id),
    Constraint FKPostulanteConocimientoTecnico_ConocimientoTecnico Foreign Key(idConocimientoTecnico) References ConocimientoTecnico(id)
)Engine=InnoDb;

Create Table PostulanteExperienciaLaboral(
    id                                  Int(255) Auto_Increment Not Null,
    idPostulante                        Int(255) Not Null,
    tipoExperiencia                     VarChar(25) Not Null,
    idCargo                             Int(255) Not Null,
    nivel                               VarChar(25) Not Null,
    idTipoEntidad                       Int(255) Not Null,
    idEntidad                           Int(255) Not Null,
    fechaInicio                         Date Not Null,
    fechaFin                            Date Not Null,
    nombreArchivoConstancia             VarChar(50) Not Null,
    Constraint PKPostulanteExperienciaLaboral Primary Key(id),
    Constraint UQPostulanteExperienciaLaboral Unique(idPostulante, tipoExperiencia, idCargo, nivel, idEntidad),
    Constraint FKPostulanteExperienciaLaboral_Postulante Foreign Key(idPostulante) References Postulante(id),
    Constraint FKPostulanteExperienciaLaboral_Cargo Foreign Key(idCargo) References Cargo(id),
    Constraint FKPostulanteExperienciaLaboral_TipoEntidad Foreign Key(idTipoEntidad) References TipoEntidad(id),
    Constraint FKPostulanteExperienciaLaboral_Entidad Foreign Key(idEntidad) References Entidad(id)
)Engine=InnoDb;