import Carreto from "../Carreto/Carreto";
import styles from "./header.module.scss";

function Header() {
  return (
    <header className={styles.header}>
      <a href="#"> Link 1</a>
      <a href="#"> Link 2</a>
      <a href="#"> Link 3</a>
      <a href="#"> Link 4</a>
      <Carreto></Carreto>
    </header>
  );
}

export default Header;
