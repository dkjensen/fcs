export interface Root {
  title: string | null;
  data: Data;
}

export interface Data {
  headers: string[]
  rows: Row[]
}

export interface Row {
  id: number
  fname: string
  lname: string
  email: string
  date: number
}
