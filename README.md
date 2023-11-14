# Trabajo Final de Taller de Ingeniería de Software 2
*Integrantes del equipo: Cristofer Alarcón, Felipe Espinoza, Victor Gatica y Francisco Salazar.*

## Descripción del proyecto
El proyecto consta en crear una aplicación móvil para turismo. Esto quiere decir que un usuario podrá subir a la app sus establecimientos turísticos o una atracción turística y otros usuarios podrán verlas con imágenes, detalles del establecimiento o atracción, ubicación/dirección, valoración (asignada por los mismos usuarios de la app), entre otros.

## Detalles técnicos
Para programar la aplicación móvil se utilizó el framework Ionic 3. A continuación, se muestran instrucciones para instalar el framework:

#### Paso 1
Asegúrese de tener *Node.js* instalado. 

#### Paso 2
Luego, para instalar *Ionic* y *Cordova* en su computador utilice:

``` 
$ npm install -g ionic cordova
```
#### Paso 3
Cree la aplicación con Ionic:
```
$ ionic start proyectoTis2 blank --type=ionic-angular
```
#### Plugins instalados:
```
$ionic cordova plugin add cordova-plugin-telerik-imagepicker@2.3.3
$npm install --save @ionic-native/image-picker@4
```
```
$ionic cordova plugin add cordova-plugin-file   
$npm install --save @ionic-native/file@4   
```

## Ejecución:
Para ejecutar la aplicación:

```
$ cd proyectoTis2
$ ionic serve
```
