import React from "react";
import { Select } from "antd";
import type { SelectProps } from "antd";

const options: SelectProps["options"] = [];

const handleChange = (value: string) => {
  console.log(`selected ${value}`);
};

const SelectBox = () => (
  <Select
    mode="tags"
    style={{ width: "100%" }}
    placeholder="Tags Mode"
    onChange={handleChange}
    options={options}
  />
);

export default SelectBox;
