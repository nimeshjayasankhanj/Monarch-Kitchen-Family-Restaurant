import React from "react";
import { Layout, Menu } from "antd";
import Link from "next/link";
import { LoginOutlined } from "@ant-design/icons";
import Image from "next/image";

const { Header } = Layout;
const SubMenu = Menu.SubMenu;

const HeaderBar: React.FC = () => {
  return (
    <Header>
      <div className="logo">
        {/* <Image src="/logo.png" alt="logo" width={100} height={100} /> */}
      </div>

      <Menu mode="horizontal">
        <Menu.Item key="finance">
          <Link href="/"> Home </Link>
        </Menu.Item>

        <Menu.Item key="party" style={{ marginLeft: "auto" }}>
          <Link href="login">
            <LoginOutlined /> Login{" "}
          </Link>
        </Menu.Item>
      </Menu>
    </Header>
  );
};

export default HeaderBar;
