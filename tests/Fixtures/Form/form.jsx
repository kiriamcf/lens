import React from "react";

const FormComponent = ({
  action = "#",
  method = "POST",
  enctype = "application/x-www-form-urlencoded",
}) => {
  return (
    <>
      {/* ✅ Good: Specifies action, method and enctype */}
      <form action={action} method={method} enctype={enctype}>...</form>

      {/* ❌ Bad: Missing action */}
      <form method={method} enctype={enctype}>...</form>

      {/* ⚠️ Bad: Missing method */}
      <form action={action} enctype={enctype}>...</form>

      {/* ⚠️ Bad: Missing enctype */}
      <form action={action} method={method}>...</form>

      {/* ❌ Bad: No attributes */}
      <form></form>
    </>
  );
};

export default ButtonComponent;