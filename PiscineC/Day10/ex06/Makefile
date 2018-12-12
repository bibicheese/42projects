#******************************************************************************#
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: jmondino <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2018/08/21 10:48:34 by jmondino          #+#    #+#              #
#    Updated: 2018/08/22 09:24:59 by jmondino         ###   ########.fr        #
#                                                                              #
#******************************************************************************#

NAME = do-op

SRC = basic_function.c do_op.c main.c\

OBJ = basic_function.o do_op.o main.o\

all: $(NAME)

$(NAME):
	gcc -Wextra -Werror -Wall -c $(SRC)
	gcc -Wextra -Werror -Wall -o $(NAME) $(OBJ)

clean:
	rm -f $(OBJ)

fclean: clean
	rm -f $(NAME)

re: fclean all