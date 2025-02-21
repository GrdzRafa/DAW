import { createContext, useState } from "react";

const ProductContext = createContext(null);

const ProductProvider = ({children}) => {
    const[carreto, setCarreto] = useState([]);
    return(
        <ProductContext.Provider value={{carreto, setCarreto}}>
            {children}
        </ProductContext.Provider>
    )
}

export {ProductContext};
export default ProductProvider;