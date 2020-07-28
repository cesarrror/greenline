import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { Router, ActivatedRoute } from "@angular/router";
import { first } from "rxjs/operators";

import { AuthServiceService } from "../../services/auth-service.service";
import { AlertService } from "../../services/alert.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  loginForm: FormGroup;
  loading = false;
  submitted = false;
  returnUrl: String;

  constructor(
    private formBuilder: FormBuilder,
    private route: ActivatedRoute,
    private router: Router,
    private authenticationService: AuthServiceService,
    private alertService: AlertService
  ) {
    if(this.authenticationService.currentUserValue){
      this.router.navigate(['/dashboard']);
    }
  }

  ngOnInit(): void {
    this.loginForm = this.formBuilder.group({
      email: ['', Validators.required],
      password: ['', Validators.required],
      remember_me: [false]
    });

    this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
  }
  
  // Convenience getter for easy access to form fields
  get f(){ return this.loginForm.controls; }


  onSubmit(){
    this.submitted = true;
    this.loading = true;

    this.alertService.clear();

    if(this.loginForm.invalid){
      this.loading = false;
      return;
    }

    this.authenticationService.login(this.f.email.value, this.f.password.value, this.f.remember_me.value)
      .pipe(first())
      .subscribe(
        data => {
          this.router.navigate(['/dashboard']);
        },
        error => {
          if(error.error.errors.email){
            error = error.error.errors.email[0];
          }else if(error.error.errors.password){
            error = error.error.errors.password[0];
          }else if(error.error.errors.remember_me){
            error = error.error.errors.remember_me[0];
          }
          this.alertService.error(error);
          this.loading = false;
        }
      )

  }

}
