import "./App.css";

import ProductProvider from "./components/Contexts/ProductContext";
import VisibleProvider from "./components/Contexts/VisibleContext";

import MemoizedHeader from "./components/Header/Header";
import MemoizedCartIcon from "./components/Carreto/CartIcon";
import MemoizedContent from "./components/Content/Content";
import Filtres from "./components/Filtres/Filtres";

import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";


library.add(fas);

function App() {
  return (
    <ProductProvider>
      <VisibleProvider>
        <div id="header">
          <MemoizedHeader></MemoizedHeader>
          <MemoizedCartIcon></MemoizedCartIcon>
        </div>
      </VisibleProvider>
      <MemoizedContent></MemoizedContent>
      <Filtres></Filtres>
    </ProductProvider>
  );
}

export default App;
