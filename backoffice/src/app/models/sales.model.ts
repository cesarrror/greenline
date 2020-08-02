export class Sales_Per_User{
    constructor(
        private _id : Number,
        public user_id : Number,
        public ticket : String,
        public subtotal : Number,
        public taxes : Number,
        public created_at : String,
        public updated_at : String
    ){}
}