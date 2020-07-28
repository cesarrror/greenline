export class Login_User{
    constructor(
        public email: String,
        public password : String,
        public remember_me : Boolean
    ){

    }
}

export class Authenticated{
    constructor(
        public access_token: String,
        public token_type: String,
        public expires_at: String
    ){

    }
}

export class UserData{
    constructor(
        private _id : Number,
        public first_name : String,
        public last_name : String,
        public email : String,
        public cellphone : String,
        public user : String,
        public role_id : Number,
        public active : Number,
        public avatar : String
    ){}
}