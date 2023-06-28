import React, { ReactNode } from "react";
import FooterBar from "../footer/footer";
import MenuBar from "../header/header";

interface layOutProps {
  children: ReactNode;
}

const Layout = ({ children }: layOutProps) => {
  return (
    <>
      <MenuBar />
      <div style={{ padding: "20px" }}>{children}</div>
      <FooterBar />
    </>
  );
};

export default Layout;
