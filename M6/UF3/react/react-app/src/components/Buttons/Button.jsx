import React from "react";

function Button({ className, onClick, children }) {
  return (
    <button className={className} onClick={onClick}>
      {children}
    </button>
  );
}

const MemoizedButton = React.memo(Button);
export default MemoizedButton;
