import { Form } from "react-router-dom";

const SearchInput = () => {
    return (
        
            <Form className="bg-white flex w-1/3 items-center rounded-md px-4 py-1">
                <input className=" w-full border-0 focus:outline-0 focus:border-0" type="text" placeholder="Search..." />
                <button type="submit" className="bg-primary text-white rounded p-2 px-2 hover:bg-primary-dark focus:outline-none flex items-center justify-center hover:bg-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                    <path strokeLinecap="round" strokeLinejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
            </Form>
            
        
    );
}

export default SearchInput
