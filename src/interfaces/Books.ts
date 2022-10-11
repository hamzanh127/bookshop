import { ApiResource } from "../utils/types";

export interface Books extends ApiResource {
  title?: string;
  description?: string;
}
