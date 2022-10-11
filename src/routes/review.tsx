import { Route } from "react-router-dom";
import { List, Create, Update, Show } from "../components/review/";

const routes = [
  <Route path="/reviews/create" element={<Create />} key="create" />,
  <Route path="/reviews/edit/:id" element={<Update />} key="update" />,
  <Route path="/reviews/show/:id" element={<Show />} key="show" />,
  <Route path="/reviews" element={<List />} key="list" />,
  <Route path="/reviews/:page" element={<List />} key="page" />,
];

export default routes;
