import { ApiResource } from "../utils/types";

export interface Review extends ApiResource {
  fullName?: string;
  email?: string;
  comment?: string;
  creationDate?: string;
  book?: any;
}
