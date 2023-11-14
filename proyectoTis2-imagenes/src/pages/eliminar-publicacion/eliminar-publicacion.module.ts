import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { EliminarPublicacionPage } from './eliminar-publicacion';

@NgModule({
  declarations: [
    EliminarPublicacionPage,
  ],
  imports: [
    IonicPageModule.forChild(EliminarPublicacionPage),
  ],
})
export class EliminarPublicacionPageModule {}
