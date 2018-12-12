/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   header.h                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/21 10:38:30 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/21 23:20:28 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef HEADER_H
# define HEADER_H

# include <unistd.h>
# include <stdlib.h>
# define SPACES(y)   y == ' ' || y == '\n' || y == '\t'
# define OPERATOR(x) x == '+' || x == '-' || x == '/' || x == '*' || x == '%'

char	*removespaces(char *str);
int		result(char *str);
void	ft_putchar(char c);
void	ft_putstr(char *str);
void	ft_putnbr(int nb);
int		ft_atoi(char *str);
int		do_op(int nb1, int nb2, char operator);

#endif
