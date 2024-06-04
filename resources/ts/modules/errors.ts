export default {
    methods: {
        /**
         * Parse error messages for a specific input.
         *
         * @param inputName string
         * @param allErrors Record<string, Array<string>>
         * @return string
         */
        parseValidationErrors(
            allErrors: Record<string, Array<string>> = {}
        ): string | null {
            const errorList = Object.values(allErrors);
            if (!errorList.length) {
                return null;
            }
            return errorList
                .reduce((oldInputErrors: Array<string> | null, inputErrors) =>
                    oldInputErrors
                        ? oldInputErrors.concat(inputErrors)
                        : inputErrors
                )
                .reduce(
                    (oldInputString: string | null, inputString: string) =>
                        (oldInputString ? `${oldInputString}, ` : "") +
                        inputString
                );
        },
        /**
         * Parse error messages for a specific input.
         *
         * @param inputName string
         * @param allErrors Record<string, Array<string>>
         * @return string
         */
        parseValidationInput(
            inputName: string,
            allErrors: Record<string, Array<string>> = {}
        ): string | null {
            let errorList = [] as Array<string>;
            Object.keys(allErrors).filter((value, index) => {
                if (value == inputName) {
                    errorList = allErrors[index];
                }
            });
            return errorList.length
                ? errorList.reduce((oldString: string | null, string) => {
                    return (oldString ? `${oldString}, ` : "") + string;
                })
                : null;
        },
        /**
          * Return error message after the ajax call.
          * @return void
          */
        ajaxErrorHandler(e: any): void {
            let message = "An error has occurred";
            if (e.response.status === 422) {
                message = this.parseValidationErrors(
                    e.response?.data?.errors ?? {}
                ) || message;
                if (window.vueDebug) {
                    console.warn(e.response.data.errors);
                }
            } else if (e.response.status === 419) {
                console.log("Your session has expired, the page will be reloaded");
                setTimeout(() => window.location.reload(), 2000);
            } else if (e.response.status === 403) {
                console.log("You are not authorized to perform this action");
                setTimeout(() => window.location.reload(), 2000);
            } else {
                if (window.vueDebug) {
                    console.error(e);
                }
            }
            console.log(message);
        }
    },
};
