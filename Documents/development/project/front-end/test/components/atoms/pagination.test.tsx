import "@testing-library/jest-dom";
import { screen, render } from "@testing-library/react";
import Pagination from "@/components/atoms/pagination";

describe("pagination component", () => {
  beforeAll(() => {
    Object.defineProperty(window, "matchMedia", {
      value: jest.fn(() => {
        return {
          matches: true,
          addListener: jest.fn(),
          removeListener: jest.fn(),
        };
      }),
    });
  });
  test("should be render pagination with 2 pages", () => {
    render(<Pagination currentPage={1} total={1} />);
    expect(screen.getByText(/1/!)).toBeInTheDocument();
  });
});
