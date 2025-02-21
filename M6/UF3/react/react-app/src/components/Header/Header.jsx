import styles from "./header.module.scss";
import React from "react";

function Header() {
  return (
    <header className={styles.header}>
      <a href="#"> Link 1</a>
      <a href="#"> Link 2</a>
      <a href="#"> Link 3</a>
      <a href="#"> Link 4</a>
    </header>
  );
}
const MemoizedHeader = React.memo(Header);
export default MemoizedHeader;
