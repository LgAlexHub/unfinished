export interface Member {
    id? : number,
    firstName : string,
    lastName : string,
    isMinor : boolean,
    joinedAt : Date|string,
    createdAt : Date|string,
    updatedAt : Date|string,
}