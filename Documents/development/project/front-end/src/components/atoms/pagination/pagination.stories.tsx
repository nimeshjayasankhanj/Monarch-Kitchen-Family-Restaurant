import type { Meta, StoryObj } from "@storybook/react";

import Pagination from "./index";

const meta: Meta<typeof Pagination> = {
  title: "pagination",
  component: Pagination,
};

export default meta;
type Story = StoryObj<typeof Pagination>;

export const Index: Story = {
  args: {
    currentPage: 1,
    total: 50,
  },
};
