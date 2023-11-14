import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { MisPublicacionesGuardadasPage } from './mis-publicaciones-guardadas';

@NgModule({
  declarations: [
    MisPublicacionesGuardadasPage,
  ],
  imports: [
    IonicPageModule.forChild(MisPublicacionesGuardadasPage),
  ],
})
export class MisPublicacionesGuardadasPageModule {}
