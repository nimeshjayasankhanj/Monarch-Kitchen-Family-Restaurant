import "@testing-library/jest-dom";
import { screen, render } from "@testing-library/react";
import SearchBox from "@/components/atoms/search-bar";

describe("search bar component", () => {
  test("should be render search bar component", () => {
    const func = jest.fn();
    render(<SearchBox value="abc" onSearch={func} />);
    expect(screen.getByDisplayValue(/abc/!)).toBeInTheDocument();
  });
});
