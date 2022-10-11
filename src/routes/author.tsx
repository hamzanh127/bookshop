import { Route } from "react-router-dom";
import { List, Create, Update, Show } from "../components/author/";

const routes = [
  <Route path="/authors/create" element={<Create />} key="create" />,
  <Route path="/authors/edit/:id" element={<Update />} key="update" />,
  <Route path="/authors/show/:id" element={<Show />} key="show" />,
  <Route path="/authors" element={<List />} key="list" />,
  <Route path="/authors/:page" element={<List />} key="page" />,
];

export default routes;
