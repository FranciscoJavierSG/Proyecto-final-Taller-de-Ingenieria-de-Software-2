import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { EditCuentaPage } from './edit-cuenta';

@NgModule({
  declarations: [
    EditCuentaPage,
  ],
  imports: [
    IonicPageModule.forChild(EditCuentaPage),
  ],
})
export class EditCuentaPageModule {}
