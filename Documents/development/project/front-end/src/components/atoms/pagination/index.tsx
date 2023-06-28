import React from "react";
import { Pagination } from "antd";

interface PaginationProps {
  currentPage: number;
  total: number;
}

const Index = ({ currentPage, total }: PaginationProps) => {
  return <Pagination defaultCurrent={currentPage} total={total} />;
};

export default Index;
