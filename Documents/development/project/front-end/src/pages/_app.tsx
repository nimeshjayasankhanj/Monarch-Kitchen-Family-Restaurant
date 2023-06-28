import Layout from "@/components/organisms/layout/layout";
import "@/styles/globals.css";
import type { AppProps } from "next/app";
import { ConfigProvider } from "antd";
import { SessionProvider } from "next-auth/react";

export default function App({ Component, pageProps }: AppProps) {
  return (
    <SessionProvider session={pageProps.session}>
      <ConfigProvider
        theme={{
          components: {
            Layout: {
              colorBgHeader: "#8b26b2",
              colorBgBody: "#8b26b2",
            },
            Menu: {
              colorItemBg: "#8b26b2",
              colorItemText: "white",
            },
          },
        }}
      >
        <Layout>
          {/* <div style={{ height: "78vh" }}> */}
          <Component {...pageProps} />
          {/* </div> */}
        </Layout>
      </ConfigProvider>
    </SessionProvider>
  );
}
