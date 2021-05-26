import { Component, OnInit } from '@angular/core';

import { AuthServiceService } from "../../../services/auth-service.service";

@Component({
  selector: 'navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  public user;
  public showMenu: boolean = true;

  constructor(private AuthenticationService: AuthServiceService) { }

  ngOnInit(): void {
    if(this.AuthenticationService.UserDataValue){
      this.user = this.AuthenticationService.UserDataValue;
    }
  }

  closeSession(){
    this.AuthenticationService.logout()
      .pipe()
      .subscribe(
        data => {
          localStorage.clear();
          window.location.reload();
        },
        error => {

        }
      )
  }

}
