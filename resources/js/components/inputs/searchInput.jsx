import { Form } from "react-router-dom";
import SearchButton from "../buttons/searchButton";

const SearchInput = () => {
    return (
        <Form className="bg-white flex w-1/3 items-center rounded-md px-2 py-1">
            <input
                className=" w-full border-0 focus:outline-0 focus:border-0"
                type="text"
                placeholder="Search..."
            />
            <SearchButton />
        </Form>
    );
};

export default SearchInput;
