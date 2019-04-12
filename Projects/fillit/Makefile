# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: jmondino <marvin@42.fr>                    +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/03/27 17:46:18 by jmondino          #+#    #+#              #
#    Updated: 2019/03/27 17:46:18 by jmondino         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #


NAME = fillit

SRC = adaptation.c backtracking.c check.c checkform.c create_ttrm.c functions.c functions2.c functions3.c get_next_line.c main.c misc.c place_ttrm.c 

OBJ = $(SRC:.c=.o)

FLAGS = -Wextra -Wall -Werror

ifndef VERBOSE
.SILENT:
endif

all:$(NAME)

$(NAME): $(OBJ)
	gcc $(FLAGS) -o $(NAME) $(OBJ)
	echo "\033[32m$(NAME) compiled.\033[0m"

clean:
	/bin/rm -f $(OBJ)
	echo "\033[32mAll .o have been erased.\033[0m"

fclean: clean
	/bin/rm -f $(NAME)
	echo "\033[32m$(NAME) erased.\033[0m"

re: fclean all
