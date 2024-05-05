import { ApplicationConfig } from '@angular/core';
import { provideRouter } from '@angular/router';

import { routes } from './app.routes';
import { provideClientHydration } from '@angular/platform-browser';
import {provideHttpClient} from "@angular/common/http";
// @ts-ignore
import { provideFirebaseApps } from '@angular/fire';

export const appConfig: ApplicationConfig = {
  providers: [
    provideRouter(routes),
    provideClientHydration(),
    provideHttpClient(),
    provideFirebaseApps({
    apiKey: "AIzaSyCz_aeVMZcpyqk1fY3XJoYClcj5D0oMHLc",
    authDomain: "task-manager-by-aka.firebaseapp.com",
    projectId: "task-manager-by-aka",
    storageBucket: "task-manager-by-aka.appspot.com",
    messagingSenderId: "463067113527",
    appId: "1:463067113527:web:a4de5c9db118fa398f37b2"
    })
  ]
};
