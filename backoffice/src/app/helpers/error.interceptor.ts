import { Injectable, inject } from "@angular/core";
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from "@angular/common/http";
import { Observable, throwError } from "rxjs";
import { catchError } from "rxjs/operators";

import { AuthServiceService } from "../services/auth-service.service";

@Injectable()
export class ErrorInterceptor implements HttpInterceptor{
    constructor(private authenticationService: AuthServiceService){}

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>>{
        return next.handle(request).pipe(catchError(err => {
            if(err.status === 401){
                this.authenticationService.logout();
                // location.reload(true);
            }

            const error = err.error.message || err.statusText;
            return throwError(error);
        }))
    }
}