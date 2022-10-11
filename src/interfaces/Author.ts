import { ApiResource } from "../utils/types";

export interface Author extends ApiResource {
  firstName?: string;
  lastName?: string;
  bibliography?: string;
  books?: string[];
}
