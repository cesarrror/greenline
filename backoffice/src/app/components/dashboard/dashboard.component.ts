import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";
import { first } from "rxjs/operators";

import { AuthServiceService } from "../../services/auth-service.service";
import { THIS_EXPR } from '@angular/compiler/src/output/output_ast';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {
  public user;
  public ComponentName: any;
  public today;

  constructor(
    private authenticationService: AuthServiceService,
    private router: Router
  ) {
    if( !this.authenticationService.currentUserValue ){
      this.router.navigate(['/']);
    }
  }

  ngOnInit(): void {
    if(localStorage.getItem('currentUser')){
      if(!localStorage.getItem('userData')){
        this.authenticationService.userAuthenticated()
          .pipe(first())
          .subscribe()
      }else{
        this.user = this.authenticationService.UserDataValue;
      }
    }

    let componentName = this.router.url;
    // let componentName = this.constructor.name.toLowerCase();
    // componentName = componentName.replace('component','');
    componentName = componentName.split('/')[0] !== '' ? componentName.split('/')[0] : componentName.split('/')[1];
    this.ComponentName = componentName;

    this.getCurrentDate();
    // this.today = new Date().toLocaleDateString();
  }

  getCurrentDate(){
    var today = new Date();
    this.today = ("0"+today.getDate()).slice(-2)+"/"+("0"+(today.getMonth()+1)).slice(-2)+"/"+today.getFullYear();
  }

}
