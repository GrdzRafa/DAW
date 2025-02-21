import { createContext, useState } from "react";

const VisibleContext = createContext(null);

const VisibleProvider = ({children}) => {
    const [cartVisible, setCartVisible] = useState(false);
    return (
        <VisibleContext.Provider value={{cartVisible, setCartVisible}}>
            {children}
        </VisibleContext.Provider>
  )
}

export {VisibleContext};
export default VisibleProvider;