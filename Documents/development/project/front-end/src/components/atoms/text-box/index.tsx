import { Form, Input } from "antd";
import { Controller } from "react-hook-form";

interface inputBoxProps {
  label: string;
  name: string;
  control: any;
  type?: string;
  errors?: string;
}

const InputBox = ({ label, name, control, type, errors }: inputBoxProps) => {
  return (
    <Form.Item name="note" label={label}>
      {type ? (
        <>
          <Controller
            name={name}
            control={control}
            render={({ field }) => (
              <Input.Password
                {...field}
                placeholder={label}
                status={errors ? "error" : ""}
                autoComplete="off"
                type="text"
              />
            )}
          />
          <small style={{ color: "red" }}>{errors}</small>
        </>
      ) : (
        <>
          <Controller
            name={name}
            control={control}
            render={({ field }) => (
              <Input
                {...field}
                placeholder={label}
                status={errors ? "error" : ""}
                autoComplete="off"
              />
            )}
          />
          <small style={{ color: "red" }}>{errors}</small>
        </>
      )}
    </Form.Item>
  );
};

export default InputBox;
